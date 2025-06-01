export type ApiKey = {
    id: number;
    uuid: string;
    user_id: number;
    name: string;
    key?: string; // Optionnel car masqué sauf à la création
    created_at: string | Date;
    updated_at: string | Date;
};
