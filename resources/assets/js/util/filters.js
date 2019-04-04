import moment from 'moment'

export function diffForHuman (datetime) {
  return moment(datetime).fromNow()
}