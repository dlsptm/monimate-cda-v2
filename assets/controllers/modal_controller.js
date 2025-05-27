import { Controller } from '@hotwired/stimulus'

export default class extends Controller {
    static targets = ['modal', 'modalBody']
    static values = {
        url: String
    }

    show(event) {
        event?.preventDefault()
        this.modalTarget.classList.remove('hidden')
    }

    hide() {
        this.modalTarget.classList.add('hidden')
        this.modalBodyTarget.innerHTML = '' // clean form
    }

    async load(event) {
        event.preventDefault()
        const response = await fetch(this.urlValue)
        const html = await response.text()

        this.modalBodyTarget.innerHTML = html
        this.show()
    }
}
