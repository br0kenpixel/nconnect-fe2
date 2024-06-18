import type { CustomPageVisibility, Schedule, SimplifiedStage } from "./public";

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

export type User = {
    id: number;
    name: string;
};

export type Administrator = {
    id: number,
    email: string,
    name: string,
};

export type AdminDialog = {
    id: number | null,
    name: string,
    email: string,
    password: string | null
};

export type AttendeeRegistration = {
    attendee: {
        id: number,
        name: string,
        email: string
    },
    registrations: Schedule[]
}