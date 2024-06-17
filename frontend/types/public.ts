import type { Conference } from "./private";

export type Speaker = {
    id: number;
    name: string;
    image: string;
    company: string;
    description: string;
    headliner: boolean;
};

export type Sponsor = {
    id: number;
    name: string;
    image: string;
};

export type Schedule = {
    id: number;
    title: string;
    description: string;
    start: string;
    end: string;
    speaker: Speaker | null;
    seats: number;
};

export type SimplifiedStage = {
    id: number;
    name: string;
    schedule: Schedule[];
};

export type FullSchedule = {
    id: number;
    year: number;
    date: string;
    stages: SimplifiedStage[];
};

export type Stats = {
    conferences: number;
    attendees: number;
    stages: number;
    next_conference: number;
    last_registration: number;
};

export type CustomPageVisibility = "none" | "navigation" | "bottom";

export type SimplifiedCustomPage = {
    id: number;
    name: string;
    display: CustomPageVisibility;
};

export type Review = {
    id: number;
    name: string;
    opinion: string;
    position: string;
    image: string;
};

export type Contact = {
    id: number;
    name: string;
    phone: string;
    email: string;
    image: string;
};

export type GalleryImage = {
    id: number;
    image: string;
};

export type Gallery = {
    conference: Conference;
    gallery: GalleryImage[];
};

export type RegistrationSelection = {
    stage: SimplifiedStage,
    presentation: Schedule
};

export type RegistrationForm = {
    id: number | null,
    email: string,
    selection: RegistrationSelection[],
};

export type RegistrationStatus = {
    closed: boolean;
    conference: Conference | null;
}