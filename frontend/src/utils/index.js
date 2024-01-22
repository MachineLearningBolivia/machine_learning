export const createSlug = (text) => {
  let cleanedText = text
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .toLowerCase();
  cleanedText = cleanedText.replace(/[^a-z0-9]+/g, "-");
  cleanedText = cleanedText.replace(/^-+|-+$/g, "");
  return cleanedText;
};
