import { SITE_URL, ApiEndpoint } from "../config.js";

import { Post } from "./interfaces/post.js";
import { createSkeleton } from "./utils/create-skeleton.js";

import { getImageUrl } from "./utils/get-image-url.js";
import { months } from "./utils/months.js";

const d: Document = document;
const rootElement: HTMLElement | null = d.getElementById("root");
const dataPostsAttr: string | null =
  rootElement?.getAttribute("data-posts") ?? null;
const postsToFetch: number =
  dataPostsAttr !== null ? parseInt(dataPostsAttr, 10) : 3;

const skeletonContainer = document.getElementById("skeleton");

const URL: string = `${SITE_URL}${ApiEndpoint}`;
const categoryId: number = 11;
const categoryUrl: string = `${URL}?categories=${categoryId}&per_page=${postsToFetch}`;

const createModal = () => {
  const modal: HTMLDivElement = d.createElement("div");
  modal.id = "modal";
  modal.classList.add("modal");
  modal.style.display = "none"; // Modal hidden inittialy.

  const modalContent: HTMLDivElement = d.createElement("div");
  modalContent.classList.add("modal-content");

  const closeBtn: HTMLSpanElement = d.createElement("span");
  closeBtn.classList.add("close-btn");
  closeBtn.innerHTML = "&times"; // Close button.

  const fullContentDiv: HTMLDivElement = d.createElement("div");
  fullContentDiv.id = "modal-full-content";

  modalContent.appendChild(closeBtn);
  modalContent.appendChild(fullContentDiv);
  modal.appendChild(modalContent);
  d.body.appendChild(modal);

  // Add event listeners to close the modal.
  closeBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event: MouseEvent) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
};

const addModalListeners = () => {
  const modal: HTMLElement | null = d.getElementById("modal");
  const fullContentDiv: HTMLElement | null =
    d.getElementById("modal-full-content");

  d.querySelectorAll(".details-button").forEach((button) => {
    button.addEventListener("click", async (event) => {
      event.preventDefault();
      try {
        // Fetch full content of the post.
        const postId: string | null = button.getAttribute("data-post-id");
        if (!postId) throw new Error("Post ID not found");

        const fullContentUrl: string = `${URL}/${postId}`;

        const response: Response = await fetch(fullContentUrl);
        if (response.ok) {
          const postData: any = await response.json();

          const title: string = postData.title.rendered;
          const location: string = postData.acf.ubicacion;
          const modality: string = postData.acf.modalidad;
          const breeder: string = postData.acf.cabana;
          const fullContent: string = postData.content.rendered;

          const date: Date = new Date(postData.acf.inicio_del_remate);
          const year: number = date.getFullYear();
          const month: string = months[date.getMonth() + 1];
          const day: number = date.getDate();

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
                        `;
          }
          if (modal) {
            modal.style.display = "flex";
          }
        } else {
          throw new Error(`Error fetching the url ${fullContentUrl}`);
        }
      } catch (error) {
        console.error("Error fetching full content: ", error);
      }
    });
  });
};

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

  // Clean the skeleton.
  if (!rootElement) {
    console.error('Root element not found')
    return
  }
  rootElement.innerHTML = ''

  for (const post of posts) {
    const currentDate = new Date();
    const startDate = new Date(post.acf.inicio_del_remate);
    const endDate = new Date(post.acf.fin_del_remate);

    // Deduce if the event is live right now:
    // First condition returns FALSE when the event has NOT started.
    // First condition returns TRUE when the event started.
    // Second condition returns TRUE when the event has NOT finished.
    // Second condition returns FALSE when the event has finished, converting
    // the all the condition to FALSE.
    const broadCasting = startDate < currentDate && currentDate < endDate;

    const title: string = post.title.rendered;
    const imageUrl: string = await getImageUrl(post);
    const location: string = post.acf.ubicacion;
    const modality: string = post.acf.modalidad;
    const breeder: string = post.acf.cabana;
    const broadcastLink: string = post.acf.enlace_transmision;

    const year: number = startDate.getFullYear();
    const month: string = months[startDate.getMonth() + 1];
    const day: number = startDate.getDate();
    const time: string = startDate.toLocaleTimeString('es-UY', { hour: '2-digit', minute: '2-digit', hour12: false })

    const singlePostWrapper = d.createElement("div");
    singlePostWrapper.classList.add("single-post-wrapper");

    const detailsButton: string = post.content.rendered
      ? `<a href="#" class="btn btn-outline details-button" data-post-id="${post.id}">Ver detalles <i class="fa-solid fa-chevron-right"></i></a>`
      : "";

    const broadcastButton: string = broadcastLink
      ? `<a href="${broadcastLink}" target="_blank" class="btn btn-${broadCasting ? 'primary' : 'outline'}">
        ${broadCasting ? "En vivo ahora" : "Enlace transmisión"} 
        <i class="fa-solid fa-video"></i></a>`
      : "";

    singlePostWrapper.innerHTML = `
        <div class="item-wrapper">
          <div class="image-wrapper">
              <img src="${imageUrl}" alt="Imagen de ${title}" />
              <div class="metadata-wrapper">
                  <span>${day}</span>
                  <span>${month}</span>
                  <span>${year}</span>
                  <span>${time}</span>
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
  if (skeletonContainer) {
    skeletonContainer.innerHTML = '';
  }
  addModalListeners();
};

document.addEventListener("DOMContentLoaded", () => {
  createSkeleton()
  createModal();
  fetchData();
});
