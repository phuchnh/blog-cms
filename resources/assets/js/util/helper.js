const filterInputMeta = (inputArray, postId) => {
  let ArrayData = []

  if (inputArray) {
    // Add data to with post_id
    Object.keys(inputArray).forEach(item => {
      ArrayData.push({
        post_id: postId,
        meta_key: item,
        meta_value: inputArray[item],
      })
    })
  }

  return ArrayData
}

export const Helper = {
  filterInputMeta,
}