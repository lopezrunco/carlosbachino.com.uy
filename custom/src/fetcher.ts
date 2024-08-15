import { SITE_URL, ApiEndpoint } from "../config.js";
const URL: string = `${SITE_URL}${ApiEndpoint}`;

const d: Document = document;
const rootElement: HTMLElement | null = d.getElementById("root");
const dataPostsAttr: string | null =
rootElement?.getAttribute("data-posts") ?? null;
const postsToFetch: number =
dataPostsAttr !== null ? parseInt(dataPostsAttr, 10) : 3;
const categoryId: number = 11;
const finalUrl: string = `${URL}?categories=${categoryId}&per_page=${postsToFetch}`;

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
