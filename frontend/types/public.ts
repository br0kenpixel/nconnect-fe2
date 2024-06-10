import type { Stage } from "./private";

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

export type SimplifiedStage = {
    name: string,
    schedule: [
        {
            title: string,
            description: string,
            start: string,
            end: string,
            speaker?: Speaker
        }
    ]
};

export type FullSchedule = {
    year: number;
    date: string;
    stages: SimplifiedStage[];
};