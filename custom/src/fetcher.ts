import { SITE_URL, ApiEndpoint } from "../config.js";
const URL: string = `${SITE_URL}${ApiEndpoint}`;

const d: Document = document;
const rootElement: HTMLElement | null = d.getElementById("root");
const dataPostsAttr: string | null =
rootElement?.getAttribute("data-posts") ?? null;
const postsToFetch: number = dataPostsAttr !== null ? parseInt(dataPostsAttr, 10) : 30;
let currentPage: number = 1
const categoryId: number = 11;
// const finalUrl: string = `${URL}?categories=${categoryId}&per_page=${postsToFetch}&page${currentPage}`;
const finalUrl: string = `${URL}?categories=${categoryId}`;

import { renderData } from "./renderer.js";
import { Post } from "./interfaces/post.js";

export const fetchData = () => {
  fetch(finalUrl)
    .then((response: Response) => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error(`Error fetching the url ${finalUrl} `);
      }
    })
    .then((data: Post[]) => renderData(data))
    .catch((error: Error) => console.error("Error fetching the data: ", error));
};
