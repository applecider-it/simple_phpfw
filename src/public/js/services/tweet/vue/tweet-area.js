const TweetArea = {
  template: `
    <!-- 一覧 -->
    <div style="display:flex; flex-direction:column; gap:1rem;">
        <div
            v-for="tweet in tweets"
            :key="tweet.id"
            style="border: 1px solid #ddd; border-radius: 5px; padding: 1rem;"
        >
            <div>
                {{ tweet.content }}
            </div>

            <div style="font-size: 0.7rem;">
                by {{ tweet.user.name }} -
                {{ new Date(tweet.created_at).toLocaleString() }}
            </div>
        </div>
    </div>
  `,

  props: ["tweetClient", "tweets"],

  data() {
    return {
    };
  },

  methods: {
  },

  /** マウント時 */
  mounted() {
  },
};

export default TweetArea;
