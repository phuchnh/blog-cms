import moment from 'moment'

export function diffForHuman (datetime) {
  return moment(datetime).fromNow()
}

export function convertDateTime (datetime, format) {
  return moment(datetime).format(format)
}
