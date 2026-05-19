/** METAタグ内のJSONデータを返す。 */
export function getMetaJson(name: string) {
    const meta = document.querySelector(
        `meta[name="${name}"]`,
    ) as HTMLMetaElement;

    if (meta) {
        const json = meta.dataset.json;
        const arr = JSON.parse(json);

        return arr;
    }

    return null;
}
