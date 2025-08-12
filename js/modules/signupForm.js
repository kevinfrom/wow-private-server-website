import {ApiClient} from '../utilities/ApiClient'

export async function handleSignupForm(event) {
    event.preventDefault()
    this.setAttribute('disabled', 'disabled')

    const data = new FormData(this)

    if (data.get('password') !== data.get('confirm_password')) {
        alert('Passwords do not match!')
        return
    }

    try {
        alert(await ApiClient.account.create(data.get('username'), data.get('password')))
        this.reset()
    } catch (err) {
        alert(err.message)
    } finally {
        this.removeAttribute('disabled')
    }
}
