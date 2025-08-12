export const ApiClient = {
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
