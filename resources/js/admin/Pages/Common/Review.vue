<template>
  <base-review :urls="urls" :configs="configs" ref="baseReview">
    <fieldset v-for="(columns, fieldSet, index) in baseReview.columns" :class="{'mt-4': index > 0}">
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

    <div v-if="previewed" class="text-center my-4 form-btn-group">
      <button
        type="button"
        class="btn btn-dark"
        @click="previewForm()">
        {{ array_get(trans, 'ui.button.preview') }}</button>
    </div>
  </base-review>
</template>

<script>
import {Base64} from "js-base64";
import BaseReview from "../../Components/Layout/BaseReview";
import DefaultReview from "../../Components/Mixins/DefaultReview";

import MinmaxAlbum from "../../Components/Form/Static/Album";
import MinmaxAgreementStatus from "../../Components/Form/Static/AgreementStatus";
import MinmaxCollection from "../../Components/Form/Static/Collection";
import MinmaxEditorPreview from "../../Components/Form/Static/EditorPreview";
import MinmaxFileList from "../../Components/Form/Static/FileList";
import MinmaxFullAddress from "../../Components/Form/Static/FullAddress";
import MinmaxOptionList from "../../Components/Form/Static/OptionList";
import MinmaxPlainTags from "../../Components/Form/Static/PlainTags";
import MinmaxPlainText from "../../Components/Form/Static/PlainText";
import MinmaxSelection from "../../Components/Form/Static/Selection";

export default {
  name: "CommonReview",
  mixins: [DefaultReview],
  components: {
    BaseReview,
    MinmaxAlbum,
    MinmaxAgreementStatus,
    MinmaxCollection,
    MinmaxEditorPreview,
    MinmaxFileList,
    MinmaxFullAddress,
    MinmaxOptionList,
    MinmaxPlainTags,
    MinmaxPlainText,
    MinmaxSelection
  },
  computed: {
    baseReview: {
      get: function () {
        if (this.$refs.baseReview) {
          return this.$refs.baseReview;
        }

        return {};
      },
      cache: false
    },
    trans: {
      get: function () {
        if (this.baseReview.trans) {
          return this.baseReview.trans;
        }
        return {};
      },
      cache: false
    },
    previewed: function () {
      return this.filled(this.urls.preview) && this.filled(this.liveValues.parent_id);
    }
  },
  methods: {
    getComponentConfigs: function (column) {
      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;
      configs.modified = this.array_get(this.modifiedColumns, column.key);

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseReview.options);
      }

      return configs;
    },
    columnCondition: function (column) {
      let condition = column.condition;

      if (this.blank(condition)) {
        return true;
      }

      if (typeof condition === 'boolean') {
        return condition;
      }

      if (typeof condition === 'string') {
        return eval(Base64.decode(condition));
      }

      return false;
    },
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
