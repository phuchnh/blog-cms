<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchJsonFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared(/**@lang MySQL */
            ' DROP FUNCTION IF EXISTS `JSON_ARRAY_VALUE`;

                    CREATE FUNCTION `JSON_ARRAY_VALUE`(
                      _field  TEXT,
                      arrayName VARCHAR (255)
                    ) RETURNS TEXT CHARSET latin1
                    BEGIN
                      DECLARE arrayValue, arrayValueTillDelimit TEXT;
                      DECLARE arrayStartDelimiter, arrayEndDelimiter VARCHAR(10);
                      DECLARE arrayCountDelimiter INT;
                      DECLARE countBracketLeft, countBracketRight INT DEFAULT 0;
                      DECLARE X INT DEFAULT 0;
                      DECLARE arrayNameQuoted VARCHAR(255);
                      SET arrayNameQuoted = CONCAT(\'"\',arrayName,\'"\');
                      /*check arrayname exist*/
                      IF(LOCATE(arrayNameQuoted,_field)= 0) THEN
                        RETURN NULL;
                      ELSE
                        /*get value behind arrayName1*/
                        SET _field = SUBSTRING(_field,1,LENGTH(_field)-1);
                        SET arrayValue = SUBSTRING(_field, LOCATE(arrayNameQuoted,_field)+LENGTH(arrayNameQuoted)+1, LENGTH(_field));
                        /*get json delimiter*/
                        SET arrayStartDelimiter = LEFT(arrayValue, 1);
                        IF(arrayStartDelimiter=\'{\') THEN
                          SET arrayEndDelimiter = \'}\';
                          loopBrackets: WHILE X < (LENGTH(arrayValue)) DO
                          SET countBracketLeft = countBracketLeft +IF(SUBSTRING(arrayValue,X,1)=arrayStartDelimiter,1,0);
                          SET countBracketRight = countBracketRight +IF(SUBSTRING(arrayValue,X,1)=arrayEndDelimiter,1,0);
                          IF(countBracketLeft<>0 AND countBracketLeft=countBracketRight) THEN
                            SET arrayCountDelimiter = X;
                            LEAVE loopBrackets;
                          ELSE
                            SET X = X + 1;
                          END IF;
                          END WHILE;
                        ELSEIF(arrayStartDelimiter=\'[\') THEN
                          SET arrayEndDelimiter = \']\';
                          SET arrayCountDelimiter = LENGTH(SUBSTRING_INDEX(arrayValue, arrayEndDelimiter, 0));
                        ELSEIF(arrayStartDelimiter=\'"\') THEN
                          SET arrayEndDelimiter = \'"\';
                          SET arrayCountDelimiter = LENGTH(SUBSTRING_INDEX(arrayValue, arrayEndDelimiter, 0));
                        ELSE
                          SET arrayStartDelimiter = "";
                          IF((LOCATE(",",arrayValue)> LOCATE("}",arrayValue))) THEN
                            SET arrayEndDelimiter = ",";
                          ELSE
                            SET arrayEndDelimiter = "}";
                          END IF;
                          SET arrayCountDelimiter = LENGTH(SUBSTRING_INDEX(arrayValue, arrayEndDelimiter, 0));
                        END IF;
                        SET arrayValueTillDelimit = SUBSTRING(arrayValue, 1, arrayCountDelimiter);
                        SET arrayCountDelimiter = LENGTH(arrayValueTillDelimit) - LENGTH(REPLACE(arrayValueTillDelimit, arrayStartDelimiter, ""));
                        SET arrayValue = SUBSTR(arrayValue,LENGTH(arrayStartDelimiter)+1);
                        IF(arrayStartDelimiter=\'{\') THEN
                          SET arrayValue = SUBSTRING_INDEX(arrayValue, arrayEndDelimiter, arrayCountDelimiter);
                        ELSE
                          SET arrayValue = SUBSTRING_INDEX(arrayValue, arrayEndDelimiter, arrayCountDelimiter+1);
                        END IF;
                        RETURN (arrayValue);
                      END IF;
                    END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared(/**@lang MySQL */
            'DROP PROCEDURE IF EXISTS JSON_ARRAY_VALUE');
    }
}
