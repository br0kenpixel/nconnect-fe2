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