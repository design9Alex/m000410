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
  </base-show>
</template>

<script>
import { Base64 } from 'js-base64';
import BaseShow from "../../Components/Layout/BaseShow";
import DefaultShow from "../../Components/Mixins/DefaultShow";

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
  name: "CommonShow",
  mixins: [DefaultShow],
  components: {
    BaseShow,
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
    baseShow: {
      get: function () {
        if (this.$refs.baseShow) {
          return this.$refs.baseShow;
        }

        return {};
      },
      cache: false
    },
    trans: {
      get: function () {
        if (this.baseShow.trans) {
          return this.baseShow.trans;
        }
        return {};
      },
      cache: false
    }
  },
  methods: {
    getComponentConfigs: function (column) {
      let configs = JSON.parse(JSON.stringify(column.configs));

      configs.key = column.key;

      if (typeof this.array_get(configs, 'options.options') === 'string') {
        configs.options.options = this.getOptions(this.array_get(configs, 'options.options'), this.baseShow.options);
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
    }
  }
}
</script>
