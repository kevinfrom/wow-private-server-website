import {ApiClient} from '../utilities/ApiClient'

export async function handleChangePasswordForm(event) {
    event.preventDefault()
    this.setAttribute('disabled', 'disabled')

    const data = new FormData(this)

    if (data.get('new_password') !== data.get('confirm_new_password')) {
        alert('Passwords do not match!')
        return
    }

    try {
        alert(
            await ApiClient.account.changePassword(
                data.get('username'),
                data.get('current_password'),
                data.get('new_password'),
                data.get('confirm_new_password')
            )
        )

        this.reset()
    } catch (err) {
        alert(err.message)
    } finally {
        this.removeAttribute('disabled')
    }
}
