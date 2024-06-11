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