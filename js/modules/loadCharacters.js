import {ApiClient} from '../utilities/ApiClient'

export const loadCharacters = async () => {
    const characterList = document.querySelector('#characters-list tbody')

    const characters        = await ApiClient.characters.get()
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
