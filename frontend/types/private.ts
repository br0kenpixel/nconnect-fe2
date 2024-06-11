import type { CustomPageVisibility } from "./public";

export type Conference = {
    id: number;
    year: number;
    date: string;
};

export type Stage = {
    id: number;
    conference: Conference;
    name: string;
};

export type CustomPage = {
    id: number;
    name: string;
    content: string;
    display: CustomPageVisibility;
};