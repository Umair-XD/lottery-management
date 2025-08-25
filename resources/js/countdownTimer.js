export default function countdownTimer(isoDate) {
  return {
    days:      0,
    hours:     0,
    minutes:   0,
    seconds:   0,
    remaining: 0,
    _interval: null,

    start() {
      this.update()
      // update every second for live ticking
      this._interval = setInterval(() => this.update(), 1000)
    },

    update() {
      const now  = Date.now()
      const then = new Date(isoDate).getTime()
      this.remaining = then - now

      if (this.remaining <= 0) {
        clearInterval(this._interval)
        this.days = this.hours = this.minutes = this.seconds = 0
        return
      }

      // total remaining seconds
      let totalSeconds = Math.floor(this.remaining / 1000)

      this.days    = Math.floor(totalSeconds / 86400)
      totalSeconds %= 86400

      this.hours   = Math.floor(totalSeconds / 3600)
      totalSeconds %= 3600

      this.minutes = Math.floor(totalSeconds / 60)
      this.seconds = totalSeconds % 60
    }
  }
}
