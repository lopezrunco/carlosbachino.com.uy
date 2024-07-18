export interface Post {
    id: number;
    date: string;
    slug: string;
    title: { rendered: string };
    content: { rendered: string };
    link: string;
    categories: number[];
}