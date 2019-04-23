/**
 * filter array to insert data in Meta table
 * @param inputArray
 * @param postId
 * @returns {Array}
 */
const filterInputMeta = (inputArray) => {
  let ArrayData = []

  if (inputArray) {
    // Add data to with post_id
    Object.keys(inputArray).forEach(item => {
      ArrayData.push({
        meta_key: item,
        meta_value: inputArray[item],
      })
    })
  }

  return ArrayData
}

/**
 * filter array to insert data in Option table
 * @param inputArray
 * @returns {Array}
 */
const filterInputSiteOption = (inputArray) => {
  let ArrayData = []

  if (inputArray) {
    // Add data to with post_id
    Object.keys(inputArray).forEach(item => {
      ArrayData.push({
        option_name: item,
        option_value: inputArray[item],
      })
    })
  }

  return ArrayData
}

export const Helper = {
  filterInputMeta, filterInputSiteOption
}
