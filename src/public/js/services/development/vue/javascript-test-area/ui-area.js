import { showToast, setIsLoading } from "@/services/ui/message";

/**
 * UI動作確認
 */
const UIArea = {
  template: `
  <div>
    <h3>UI動作確認</h3>
    
    <div style="display:flex; flex-direction:row; gap:1rem;">
      <button type="submit" class="app-btn-primary" @click="() => uiTest('loading')">
        Loading
      </button>

      <button type="submit" class="app-btn-primary" @click="() => uiTest('toast')">
        Toast
      </button>
      
      <button type="submit" class="app-btn-primary" @click="() => uiTest('toastAlert')">
        Toast alert
      </button>
      
      <button type="submit" class="app-btn-primary" @click="() => uiTest('toast2')">
        Toast 2
      </button>
    </div>
  </div>
  `,

  methods: {
    /** UIテスト */
    uiTest(type) {
      console.log("Test type", type);

      // UIテスト
      if (type === "loading") {
        setIsLoading(true);
        setTimeout(() => {
          setIsLoading(false);
        }, 2000);
      } else if (type === "toast") {
        showToast("トーストテスト");
      } else if (type === "toastAlert") {
        showToast("トーストテスト", "alert");
      } else if (type === "toast2") {
        showToast("トーストテスト");
        showToast("トーストテスト", "alert");
      }
    },
  },
};

export default UIArea;
