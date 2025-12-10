/** トースト出力用VueHook */
let showToastHook;
/** ローディング画面のオンオフ用VueHook */
let setIsLoadingHook;

/** メッセージ管理のセットアップ */
export function setupMessage(showToastArg, setIsLoadingArg) {
    showToastHook = showToastArg;
    setIsLoadingHook = setIsLoadingArg;
}

/** トースト出力 */
export function showToast(message, type = "notice") {
    showToastHook(message, type);
}

/** ローディング画面のオンオフ */
export function setIsLoading(isLoading) {
    setIsLoadingHook(isLoading);
}
