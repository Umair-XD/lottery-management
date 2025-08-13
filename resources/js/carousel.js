// resources/js/carousel.js

export default function carouselFactory(opts) {
  return {
    endpoint:  opts.endpoint,
    dateField: opts.dateField || 'date',
    fields:    opts.fields,
    gap:       opts.gap || 10,

    active:    0,
    cards:     [],
    itemWidth: 360,
    viewportWidth: 0,

    isDragging:       false,
    startX:           0,
    currentTranslate: 0,

    async init() {
      this.viewportWidth = this.$refs.viewport.clientWidth
      await this.loadCards()
      this.active = Math.floor(this.cards.length/2)
      this._updateSizes()
      window.addEventListener('resize', () => this._updateSizes())
    },

    async loadCards() {
      try {
        const res  = await fetch(this.endpoint)
        const data = await res.json()
        const now  = Date.now()

        this.cards = data.map(item => {
          const drawMs      = new Date(item[this.dateField]).getTime()
          const secondsLeft = Math.max(Math.floor((drawMs - now)/1000), 0)

          // map your payload → generic card props
          const card = Object.fromEntries(
            Object.entries(this.fields).map(([key,payloadKey]) =>
              [ key, item[payloadKey] ]
            )
          )

          return {
            ...card,
            seconds:  secondsLeft,
            interval: null,
            days:     0,
            hours:    0,
            minutes:  0
          }
        })

        this.startTimers()
      } catch (e) {
        console.error('carousel loadCards error', e)
      }
    },

    startTimers() {
      this.cards.forEach(c => {
        this.updateTime(c)
        c.interval = setInterval(() => {
          if (c.seconds > 0) {
            c.seconds--
            this.updateTime(c)
          } else {
            clearInterval(c.interval)
          }
        }, 1000)
      })
    },

    updateTime(card) {
      let sec = card.seconds
      card.days    = Math.floor(sec/86400)
      sec %= 86400
      card.hours   = Math.floor(sec/3600)
      sec %= 3600
      card.minutes = Math.floor(sec/60)
    },

    _updateSizes() {
      this.viewportWidth = this.$refs.viewport.clientWidth
      this.itemWidth     = this.viewportWidth < 640 ? 300 : 360
    },

    get translate() {
      const center = (this.viewportWidth - this.itemWidth)/2
      const offset = this.active * (this.itemWidth + this.gap)
      return this.isDragging
        ? center - offset + this.currentTranslate
        : center - offset
    },

    prev() {
      this.active = this.active>0
        ? this.active-1
        : this.cards.length-1
    },
    next() {
      this.active = this.active<this.cards.length-1
        ? this.active+1
        : 0
    },

    dragStart(e) {
      this.isDragging = true
      this.startX      = e.type.startsWith('mouse')
        ? e.clientX
        : e.touches[0].clientX
      this.currentTranslate = 0
    },
    dragMove(e) {
      if (!this.isDragging) return
      const clientX = e.type.startsWith('mouse')
        ? e.clientX
        : e.touches[0].clientX
      this.currentTranslate = clientX - this.startX
    },
    dragEnd() {
      if (!this.isDragging) return
      this.isDragging = false
      const threshold = this.itemWidth * 0.2
      if (this.currentTranslate < -threshold) this.next()
      if (this.currentTranslate >  threshold) this.prev()
      this.currentTranslate = 0
    },

    destroy() {
      this.cards.forEach(c => clearInterval(c.interval))
    }
  }
}
