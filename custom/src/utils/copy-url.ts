export const copyUrl = (url: string) => {
    // Try to cpy the url using the clipboard API.
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url)
            .then(() => {
                alert('Se copió el enlace.')
            })
            .catch(error => {
                console.error(`Failed to copy the url. ${error}`)
            })
    } else {
        // Fallback for browsers that do not support the clipboard API.
        alert(`Url del evento: ${url}`)
    }
}
