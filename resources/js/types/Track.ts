export type Track = {
    id: number;
    uuid: string;
    title: string;
    artist: string;
    file_name: string;
    image?: string | null;
    displayed: boolean;
    play_count: number;
    created_at: string | Date;
    updated_at: string | Date;
};
