import { showToast, setIsLoading } from "@/services/ui/message";
import LoadingInline from "@/services/ui/vue/message/loading-inline";

const TweetArea = {
  props: ["tweetClient"],

  components: { LoadingInline },

  data() {
    return {
      tweets: [],
      content: "",
      errors: {},
      isInit: false,
    };
  },

  methods: {
    /** ツイート送信 */
    async handleSubmit(e) {
      e.preventDefault();

      this.errors = {};

      setIsLoading(true);

      const result = await this.tweetClient.storeTweet(this.content);

      setIsLoading(false);

      console.log(result);

      if ("errors" in result) {
        this.errors = result.errors;
      } else {
        this.content = "";
        showToast("ツイートしました。");
      }
    },

    /** ツイート一覧更新 */
    async refreshList() {
      const result = await this.tweetClient.getList();

      console.log(result.tweets);

      this.tweets = result.tweets;
    },

    /** ツイート一覧初期化 */
    async initList() {
      await this.refreshList();

      this.isInit = true;
    },
  },

  /** マウント時 */
  async mounted() {
    this.initList();

    this.tweetClient.refreshList = () => this.refreshList();
  },

  template: `
    <!-- フォーム -->
    <form @submit="handleSubmit($event)">
        <textarea
            v-model="content"
            rows="3"
            placeholder="What's happening?"
            class="app-form-input"
        />

        <div v-if="errors.content" class="app-form-error">
            {{ errors.content[0] }}
        </div>

        <button type="submit" class="app-btn-primary" style="margin-top: 1rem;">Tweet</button>
    </form>

    <div v-if="isInit">
      <!-- 一覧 -->
      <div style="display:flex; flex-direction:column; gap:1rem; margin-top: 2rem;">
          <div
              v-for="tweet in tweets"
              :key="tweet.id"
              style="border: 1px solid #ddd; border-radius: 5px; padding: 1rem;"
          >
              <div>
                  {{ tweet.content }}
              </div>

              <div style="font-size: 0.7rem; margin-top: 0.5rem; text-align: right;">
                  by {{ tweet.user.name }} -
                  {{ new Date(tweet.created_at).toLocaleString() }}
              </div>
          </div>
      </div>
    </div>
    <div v-else>
      <LoadingInline />
    </div>
  `,
};

export default TweetArea;
