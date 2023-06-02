<template>
  <base-show :urls="urls" :configs="configs" ref="baseShow">
    <fieldset v-for="(columns, fieldSet, index) in baseShow.columns" :class="{'mt-4': index > 0}">
      <legend class="legend h6 mb-4">
        <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.' + fieldSet) }}</legend>

      <component
        v-for="column in columns"
        v-if="columnCondition(column)"
        :is="column.component"
        :key="'field_' + column.key"
        :trans="trans"
        :configs="getComponentConfigs(column)"
        v-model="liveValues[column.key]"></component>

    </fieldset>

    <div class="text-center my-4 form-btn-group" v-if="previewed">
      <button class="btn btn-dark"
              type="button"
              @click="previewForm()">
        {{ array_get(trans, 'ui.button.preview') }}</button>
    </div>
  </base-show>
</template>

<script>
import CommonShow from "../Common/Show";

export default {
  extends: CommonShow,
  name: "ArticlePageShow",
  computed: {
    previewed: function () {
      return this.filled(this.urls.preview);
    }
  },
  methods: {
    previewForm: function () {
      axios.post(this.urls.preview, {previewData: this.liveValues})
        .then((response) => {
          if (response.data.code === '0000') {
            window.open(response.data.preview_url, 'pagePreview');
          } else {
            this.$swal({text: response.data.message, icon: 'error'});
          }
        })
        .catch((error) => {
          this.$swal({text: error.response.data.message, icon: 'error'});
        });
    }
  }
}
</script>
