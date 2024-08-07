import { getYouTubeVideoId } from "./getYouTubeVideoId.js"

export const getBroadcastModal = (broadcastLink: string, title: string): string => {
    const videoId = getYouTubeVideoId(broadcastLink)

    if (!videoId) throw new Error('Invalid Youtube video url')

    return `<div class="broadcasting-section">
        <div class="title">
            <i class="fa-solid fa-video"></i>
            <div>
                <h4>Transmitiendo: ${title}</h4>
            </div>
        </div>
        <iframe 
            src="https://www.youtube.com/embed/${videoId}" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; 
            autoplay; 
            clipboard-write; 
            encrypted-media; 
            gyroscope; 
            picture-in-picture" 
            allowfullscreen
        ></iframe>
    </div>`
}
