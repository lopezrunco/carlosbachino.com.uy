import { SITE_URL, ApiEndpoint } from "../config.js";

import { Post } from "./interfaces/post.js";

import { getImageUrl } from "./utils/get-image-url.js";
import { months } from "./utils/months.js";

const d: Document = document;
const rootElement: HTMLElement | null = d.getElementById("root");
const dataPostsAttr: string | null =
  rootElement?.getAttribute("data-posts") ?? null;
const postsToFetch: number =
  dataPostsAttr !== null ? parseInt(dataPostsAttr, 10) : 3;

const URL: string = `${SITE_URL}${ApiEndpoint}`;
const categoryId: number = 4;
const categoryUrl: string = `${URL}?categories=${categoryId}&per_page=${postsToFetch}`;

const createModal = () => {
    const modal: HTMLDivElement = d.createElement('div')
    modal.id = 'modal'
    modal.classList.add('modal')
    modal.style.display = 'none' // Modal hidden inittialy.

    const modalContent: HTMLDivElement = d.createElement('div')
    modalContent.classList.add('modal-content')

    const closeBtn: HTMLSpanElement = d.createElement('span')
    closeBtn.classList.add('close-btn')
    closeBtn.innerHTML = '&times' // Close button.

    const fullContentDiv: HTMLDivElement = d.createElement('div')
    fullContentDiv.id = 'modal-full-content'

    modalContent.appendChild(closeBtn)
    modalContent.appendChild(fullContentDiv)
    modal.appendChild(modalContent)
    d.body.appendChild(modal)

    // Add event listeners to close the modal.
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none'
    })

    window.addEventListener('click', (event: MouseEvent) => {
        if (event.target === modal) {
            modal.style.display = 'none'
        }
    })
}

const addModalListeners = () => {
    const modal: HTMLElement | null = d.getElementById('modal')
    const fullContentDiv: HTMLElement | null = d.getElementById('modal-full-content')

    d.querySelectorAll('.details-button').forEach(button => {
        button.addEventListener('click', async (event) => {
            event.preventDefault()
            try {
                // Fetch full content of the post.
                const postId: string | null = button.getAttribute('data-post-id')
                if (!postId) throw new Error('Post ID not found')

                const fullContentUrl: string = `${URL}/${postId}`

                const response: Response = await fetch(fullContentUrl)
                if (response.ok) {
                    const postData: any = await response.json()

                    const title: string = postData.title.rendered
                    const location: string = postData.ubicacion
                    const modality: string = postData.modalidad
                    const breeder: string = postData.cabana
                    const fullContent: string = postData.content.rendered

                    const date: Date = new Date(postData.inicio_del_remate)
                    const year: number = date.getFullYear()
                    const month: string = months[date.getMonth() + 1]
                    const day: number = date.getDate()

                    if (fullContentDiv) {
                        fullContentDiv.innerHTML = `
                            <div class="meta">
                                <h2>${title}</h2>
                                <p><b>Fecha:</b> ${day} ${month} ${year}</p>
                                <p><b>Lugar: </b> ${location} | <b>Cabaña: </b> ${breeder} | <b>Modalidad: </b> ${modality}</p>
                            </div>
                            <div class="full-content">
                                ${fullContent}
                            </div>
                        `
                    }
                    if (modal) {
                        modal.style.display = 'flex'
                    }
                } else {
                    throw new Error(`Error fetching the url ${fullContentUrl}`)
                }
            } catch (error) {
                console.error('Error fetching full content: ', error)
            }
        })
    })
}

const fetchData = () => {
  fetch(categoryUrl)
    .then((response: Response) => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error(`Error fetching the url ${categoryUrl} `);
      }
    })
    .then((data: Post[]) => renderData(data))
    .catch((error: Error) => console.error("Error fetching the data: ", error));
};

const renderData = async (posts: any[]) => {
  let postsWrapper = d.createElement("div");
  postsWrapper.classList.add("posts-wrapper");

  for (const post of posts) {
    // const startDate = new Date(post.inicio_del_remate);
    const startDate = new Date(post.date);
    console.log('=> ', startDate)

    const title: string = post.title.rendered;
    const imageUrl: string = await getImageUrl(post)
    const location: string = post.ubicacion;
    const modality: string = post.modalidad;
    const breeder: string = post.cabana;

    const excerptHtml = post.excerpt.rendered;
    const match = excerptHtml.match(/<p>(.*?)<\/p>/); 
    const broadcastLink = match ? match[1] : '';

    const year: number = startDate.getFullYear();
    const month: string = months[startDate.getMonth() + 1];
    const day: number = startDate.getDate();

    const singlePostWrapper = d.createElement("div");
    singlePostWrapper.classList.add("single-post-wrapper");

    const broadcastButton: string = broadcastLink
      ? `<a href="${broadcastLink}" target="_blank" class="btn btn-primary">Transmisión <i class="fa-solid fa-video"></i></a>`
      : "";

    const detailsButton: string = post.content.rendered
      ? `<a href="#" class="btn btn-primary details-button" data-post-id="${post.id}">Ver detalles <i class="fa-solid fa-chevron-right"></i></a>`
      : "";

    singlePostWrapper.innerHTML = `<div class="item-wrapper">
                <div class="image-wrapper">
                    <img src="${imageUrl}" alt="Imagen destacada de ${title}" />
                    <div class="metadata-wrapper">
                        <span>${day}</span>
                        <span>${month}</span>
                        <span>${year}</span>
                    </div>
                </div>
                <div class="info-wrapper">
                    <h3>${title}</h3>
                    <p><b>Lugar: </b> ${location} | <b>Cabaña: </b> ${breeder} | <b>Modalidad: </b> ${modality}</p>
                    ${detailsButton}
                    ${broadcastButton}
                </div>
            </div>`;

    postsWrapper.appendChild(singlePostWrapper);
  }
  if (rootElement) {
    rootElement.appendChild(postsWrapper);
  }
  addModalListeners()
};

document.addEventListener("DOMContentLoaded", () => {
  createModal()
  fetchData();
});
