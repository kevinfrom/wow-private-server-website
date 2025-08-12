import {loadCharacters} from './modules/loadCharacters'
import {handleSignupForm} from './modules/signupForm'
import {handleChangePasswordForm} from './modules/changePasswordForm'

document.addEventListener('DOMContentLoaded', () => {
    setInterval(() => void loadCharacters(), 60 * 1000)

    document.querySelector('form#signup-form').addEventListener('submit', handleSignupForm)
    document.querySelector('form#change-password-form').addEventListener('submit', handleChangePasswordForm)
})
