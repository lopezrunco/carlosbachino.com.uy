// Takes a string type URL parameter & returns a video ID string or null.
export const getYouTubeVideoId = (url: string): string | null => {
    const youtubeLinkPatterns = [
        /https:\/\/www\.youtube\.com\/embed\/([^"?]+)/,  // Embed URL
        /https:\/\/www\.youtube\.com\/watch\?v=([^"&?/]+)/,  // Long URL
        /https:\/\/m\.youtube\.com\/watch\?v=([^"&?/]+)/,  // Mobile URL
        /https:\/\/youtu\.be\/([^"&?/]+)/,  // Short URL
        /https:\/\/www\.youtube\.com\/live\/([^"?]+)/,  // Live stream URL
        /https:\/\/www\.youtube\.com\/watch\?v=([^"&?/]+)&t=\d+S/,  // Live stream URL with timestamp
        /https:\/\/m\.youtube\.com\/live\/([^"?]+)/  // Mobile live stream URL
    ]

    for (const pattern of youtubeLinkPatterns) {
        const match = url.match(pattern)
        if (match) {
            return match[1]
        }
    }
    return null
}