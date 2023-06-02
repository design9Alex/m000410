<template>
  <base-edit
    :urls="urls"
    :configs="configs"
    ref="baseEdit"
    :live-values="liveValues"
    v-on:draft-loaded="liveValues = $event">
    <fieldset v-for="(columns, fieldSet, index) in baseEdit.columns" :class="{'mt-4': index > 0}">
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

    <div class="text-center my-4 form-btn-group">
      <b-overlay
        :show="$store.state.formBusy"
        opacity="0.6"
        spinner-small
        spinner-variant="main"
        class="d-inline-block">
        <button
          class="btn btn-main"
          type="button"
          @click="submitForm(trans)">
          {{ array_get(trans, 'ui.button.submit') }}</button>
      </b-overlay>
      <button
        class="btn btn-default"
        type="button"
        :disabled="$store.state.formBusy"
        @click="getData">
        {{ array_get(trans, 'ui.button.reset') }}</button>
      <button
        class="btn btn-dark"
        type="button"
        v-if="previewed"
        :disabled="$store.state.formBusy"
        @click="previewForm()">
        {{ array_get(trans, 'ui.button.preview') }}</button>
    </div>
  </base-edit>
</template>

<script>
import CommonEdit from "../Common/Edit";
import MinmaxDataRelation from "../../Components/Form/DataRelation";

export default {
  extends: CommonEdit,
  name: "ArticleDownloadEdit",
  components: {
    MinmaxDataRelation
  },
  computed: {
    previewed: function () {
      return this.filled(this.urls.preview) && this.filled(this.liveValues.articleCategories);
    }
  },
  watch: {
    "liveValues.articleCategories": {
      handler: function (categories) {
        if (this.filled(this.urls.api_ui)) {
          let url = this.urls.api_ui;

          if (this.filled(categories)) {
            for (let index in categories) {
              if (!(new RegExp(/\?/)).test(url)) {
                url += '?';
              } else {
                url += '&'
              }
              url += ('categories%5B' + index + '%5D=' + categories[index]);
            }
          }
          axios
            .get(url)
            .then((response) => {
              this.baseEdit.updateUI(response.data.data.trans, response.data.data.columns, response.data.data.options);
            });
        }
      },
      deep: true,
      immediate: false
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
