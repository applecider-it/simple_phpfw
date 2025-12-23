import { ref } from "@/outer/vue3"

let cnt = 0;

/** トースト用フック */
export default function useToast() {
  const toasts = ref([]);

  const showToast = (message, type = "notice") => {
    const id = cnt++;
    toasts.value.push({ id, message, type });

    setTimeout(() => {
      toasts.value = toasts.value.filter((t) => t.id !== id);
    }, 3000);
  };

  return { toasts, showToast };
}
