/**
 * Form動作確認
 */
const FormArea = {
  template: `
  <div class="app-form">
      Form動作確認

      <div class="mt-5">
          <label for="listVal" class="app-form-label">リスト動作確認</label>
          <select v-model="listVal" id="listVal">
              <option :value="null" key="null">選択してください</option>
              <option
                  v-for="(value, key) in listVals"
                  :key="key"
                  :value="Number(key)"
              >
                  {{ value }}
              </option>
          </select>

          <p>選択中: [{{ listVal }}] {{ typeof listVal }}</p>
      </div>

      <div class="mt-5">
          <label class="app-form-label">ラジオボタン動作確認</label>
          <div class="space-x-3">
              <label v-for="(value, key) in radioVals" :key="key">
                  <input type="radio" :value="key" v-model="radioVal" />
                  {{ value }}
              </label>
          </div>

          <p>選択中: {{ radioVal }}</p>
      </div>

      <div class="mt-5">
          <label for="dateTimeVal" class="app-form-label">日時動作確認</label>
          <input
              type="datetime-local"
              v-model="dateTimeVal"
              id="dateTimeVal"
          />

          <p>選択中: {{ dateTimeVal }}</p>
      </div>

      <div class="mt-5">
          <button @click="confirmFormValue" class="app-btn-secondary">
              確認
          </button>
      </div>
  </div>
  `,

  props: ["propListVal", "propRadioVal", "propDateTimeVal", "listVals", "radioVals"],

  data() {
    return {
      listVal: this.propListVal,
      radioVal: this.propRadioVal,
      dateTimeVal: this.propDateTimeVal,
    };
  },

  methods: {
    /** フォームの値の確認 */
    confirmFormValue() {
      console.log("confirmFormValue", {
        listVal: this.listVal,
        radioVal: this.radioVal,
        dateTimeVal: this.dateTimeVal,
      });
    },
  },
};

export default FormArea;
