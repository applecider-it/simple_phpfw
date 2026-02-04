import { ref } from "@/outer/vue3";

import Toasts from "@/services/ui/vue/message/toasts";
import Loading from "@/services/ui/vue/message/loading";
import useToast from "@/services/ui/vue-hook/use-toast";
import { setupMessage } from "@/services/ui/message";

/** アプリケーションの共通部分 */
const AppCommon = {
  components: { Toasts, Loading },

  setup() {
    const { toasts, showToast } = useToast();
    const isLoading = ref(false);

    const setIsLoading = (val) => {
        isLoading.value = val;
    }

    setupMessage(showToast, setIsLoading);

    return { toasts, isLoading };
  },

  template: `
    <div>
      <Toasts :toasts="toasts" />
      <Loading :isLoading="isLoading" />
    </div>
  `,
};

export default AppCommon;
