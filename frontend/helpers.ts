import { encode } from "base64-arraybuffer";

export async function convertImage(file: File): Promise<string | null> {
    let image_content: string | null = "data:image/";
    let buffer = await file.arrayBuffer();
    let extension = file.name.substring(file.name.lastIndexOf(".") + 1);

    switch (extension.toLowerCase()) {
        case "jpg":
        case "jpeg":
            image_content += "jpg";
            break;
        case "png":
            image_content += "png";
            break;
        default:
            return null;
    }

    image_content += ";base64, ";
    image_content += encode(buffer);
    return image_content;
}