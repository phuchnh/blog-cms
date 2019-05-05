<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchJsonMainFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::unprepared(/**@lang MySQL */
            'DROP FUNCTION IF EXISTS `JSON_EXTRACT_NESTED`;

                    CREATE FUNCTION `JSON_EXTRACT_NESTED`(_field TEXT,
                                      _variable TEXT) RETURNS TEXT CHARSET latin1
                    BEGIN
                      DECLARE X INT DEFAULT 0;
                      DECLARE fieldval1 TEXT;
                      DECLARE arrayName,arrayValue TEXT;
                    
                      SET arrayName = SUBSTRING_INDEX(_variable, \'.\', 1);
                    
                      IF (LOCATE(\'%\', arrayName) > 0) THEN
                        SET _field = SUBSTRING_INDEX(_field, "{", -1);
                        SET _field = SUBSTRING_INDEX(_field, "}", 1);
                        RETURN TRIM(
                            BOTH \'"\' FROM SUBSTRING_INDEX(
                                SUBSTRING_INDEX(
                                    SUBSTRING_INDEX(
                                        _field,
                                        CONCAT(
                                            \'"\',
                                            SUBSTRING_INDEX(_variable, \'$.\', - 1),
                                            \'":\'
                                          ),
                                        - 1
                                      ),
                                    \',"\',
                                    1
                                  ),
                                \':\',
                                -1
                              )
                          );
                      ELSE
                        SET arrayValue = json_array_value(_field, arrayName);
                        WHILE X < (LENGTH(_variable) - LENGTH(REPLACE(_variable, \'.\', ""))) DO
                        IF (LENGTH(_variable) - LENGTH(REPLACE(_variable, \'.\', "")) > X) THEN
                          SET arrayName = SUBSTRING_INDEX(SUBSTRING_INDEX(_variable, \'.\', X + 2), \'.\', -1);
                        END IF;
                        IF (arrayName <> \'\') THEN
                          SET arrayValue = json_array_value(arrayValue, arrayName);
                        END IF;
                        SET X = X + 1;
                        END WHILE;
                      END IF;
                      RETURN arrayValue;
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
            'DROP PROCEDURE IF EXISTS JSON_EXTRACT_NESTED');
    }
}
