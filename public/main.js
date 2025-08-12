document.addEventListener('DOMContentLoaded', async () => {
    const api = {
        account   : {
            async create(username, password) {
                const response = await fetch('/api/accounts', {
                    method : 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body   : new URLSearchParams({
                        username,
                        password
                    }).toString()
                })

                const data = await response.json()

                if (!response.ok || data.error) {
                    throw new Error(`Error creating account: ${data.error}`)
                }

                return data['message']
            },
            async changePassword(username, currentPassword, newPassword, confirmNewPassword) {
                const response = await fetch(`/api/accounts/${username}/change-password`, {
                    method : 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body   : new URLSearchParams({
                        current_password    : currentPassword,
                        new_password        : newPassword,
                        confirm_new_password: confirmNewPassword
                    }).toString()
                })

                const data = await response.json()

                if (!response.ok || data.error) {
                    throw new Error(`Error changing password: ${data.error}`)
                }

                return data['message']
            }
        },
        characters: {
            async get() {
                const response = await fetch('/api/characters')
                const data     = await response.json()

                if (!response.ok || data.error) {
                    throw new Error(`Error fetching characters: ${data.error}`)
                }

                return data['characters']
            }
        }
    }

    const loadCharacters = async () => {
        const characterList = document.querySelector('#characters-list tbody')

        const characters        = await api.characters.get()
        characterList.innerHTML = ''

        let onlineCount = 0
        for (const character of characters) {
            if (character.online) {
                onlineCount++
            }

            characterList.innerHTML += `<tr>
                <td>${character.online ? 'Yes' : 'No'}</td>
                <td>${character.name}</td>
                <td>${character.race}</td>
                <td>${character.class}</td>
                <td>${character.level}</td>
            </tr>`
        }

        document.querySelector('#online-count').textContent = `${onlineCount}/${characters.length}`
    }

    void loadCharacters()
    setInterval(() => void loadCharacters(), 60 * 1000) // Refresh every minute

    document.querySelector('form#signup-form').addEventListener('submit', async function (event) {
        event.preventDefault()
        this.setAttribute('disabled', 'disabled')

        const data = new FormData(this)

        if (data.get('password') !== data.get('confirm_password')) {
            alert('Passwords do not match!')
            return
        }

        try {
            alert(await api.account.create(data.get('username'), data.get('password')))
            this.reset()
        } catch (err) {
            alert(err.message)
        } finally {
            this.removeAttribute('disabled')
        }
    })

    document.querySelector('form#change-password-form').addEventListener('submit', async function (event) {
        event.preventDefault()
        this.setAttribute('disabled', 'disabled')

        const data = new FormData(this)

        if (data.get('new_password') !== data.get('confirm_new_password')) {
            alert('Passwords do not match!')
            return
        }

        try {
            alert(
                await api.account.changePassword(
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
    })
})
