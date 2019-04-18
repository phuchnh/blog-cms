import moment from 'moment'

export function diffForHuman (datetime) {
  return moment(datetime).fromNow()
}

export function localeName (locale) {
  switch (locale) {
    case 'vi':
      return 'Vietnamese'
    case 'en':
      return 'English'
    default:
      return ''
  }
}

export function convertDateTime (datetime, format) {
  return moment(datetime).format(format)
}

export function capitalize (value) {
  if (!value) return ''
  return value.charAt(0).toUpperCase() + value.slice(1)
}
