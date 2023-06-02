<template>
  <base-show :urls="urls" :configs="configs" ref="baseShow">
    <template v-slot:slotSitePageActions>
      <a v-if="filled(urls.review)"
         class="btn btn-sm btn-main"
         :title="array_get(trans, 'ui.button.review')"
         :href="urls.review"
         target="_blank">
        <i class="icon-clipboard1"></i><!--
        --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.review') }}</span>
      </a>
      <button
        v-if="filled(urls.preview)" class="btn btn-sm btn-outline-main" type="button"
        :title="array_get(trans, 'ui.button.preview')"
        @click="doPreview()">
        <i class="icon-popout"></i><!--
        --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.preview') }}</span>
      </button>
      <button
        v-if="filled(urls.abort)" class="btn btn-sm btn-dark" type="button"
        :title="array_get(trans, 'ui.button.abort')"
        @click="doAbort()">
        <i class="icon-cross"></i><!--
        --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.abort') }}</span>
      </button>
    </template>

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

    <fieldset class="mt-4">
      <legend class="legend h6 mb-4">
        <i class="icon-angle-double-down2 mr-2"></i>{{ array_get(trans, 'ui.legend.signature') }}</legend>

      <div class="form-group">
        <table id="OrderForm-orderRecords" class="table table-sm table-bordered mb-1">
          <thead class="thead-default">
          <tr class="text-center bg-light">
            <th class="w-15">{{ array_get(signature.trans, 'module.created_at') }}</th>
            <th class="w-10">{{ array_get(signature.trans, 'module.result') }}</th>
            <th class="w-15">{{ array_get(signature.trans, 'module.assessor') }}</th>
            <th>{{ array_get(signature.trans, 'module.comment') }}</th>
          </tr>
          </thead>
          <tbody v-if="blank(signature.values)">
          <tr class="text-center">
            <td colspan="4" class="text-muted">{{ array_get(signature.trans, 'ui.message.empty_list') }}</td>
          </tr>
          </tbody>
          <tbody v-else class="text-center">
          <tr v-for="sign in signature.values">
            <td>{{ sign.created_at }}</td>
            <td>{{ getSignatureResult(sign.result) }}</td>
            <td>{{ sign.assessor }}</td>
            <td class="text-pre-line text-left">{{ sign.comment }}</td>
          </tr>
          </tbody>
          <tfoot v-if="filled(urls.signature.store) && !signature.disable">
          <tr>
            <td colspan="4">
              <textarea class="form-control" v-model="signature.comment"></textarea>
            </td>
          </tr>
          </tfoot>
        </table>
      </div>
    </fieldset>

    <div v-if="filled(urls.signature.store) && !signature.disable" class="text-center my-4 form-btn-group">
      <b-overlay
        :show="$store.state.formBusy && signature.result === true"
        opacity="0.6"
        spinner-small
        spinner-variant="success"
        class="d-inline-block">
        <button
          type="button"
          class="btn btn-success"
          :disabled="signature.result === false"
          @click="submitSign(true)">{{ array_get(trans, 'ui.button.approve') }}</button>
      </b-overlay>
      <b-overlay
        :show="$store.state.formBusy && signature.result === false"
        opacity="0.6"
        spinner-small
        spinner-variant="main"
        class="d-inline-block">
        <button
          type="button"
          class="btn btn-danger"
          :disabled="signature.result === true"
          @click="submitSign(false)">{{ array_get(trans, 'ui.button.reject') }}</button>
      </b-overlay>
    </div>
  </base-show>
</template>

<script>
import CommonShow from "../Common/Show";
import PageGateList from "../../Components/PageApprovalWorkflow/GateList";

export default {
  extends: CommonShow,
  name: "ApprovalCaseShow",
  components: {
    PageGateList
  },
  data() {
    return {
      signature: {
        trans: {},
        columns: [],
        options: [],
        values: [],
        comment: null,
        result: null,
        disable: false
      }
    }
  },
  created() {
    this.getSignatureUI();
  },
  mounted() {
    this.getSignatures();
  },
  methods: {
    getSignatureUI: function () {
      if (this.filled(this.array_get(this.urls, 'signature.api_ui'))) {
        axios
          .get(this.urls.signature.api_ui)
          .then((response) => {
            this.signature.trans = response.data.data.trans;
            this.signature.columns = response.data.data.columns;
            this.signature.options = response.data.data.options;
          });
      }
    },
    getSignatures: function () {
      if (this.filled(this.array_get(this.urls, 'signature.api_grid'))) {
        axios
          .post(this.urls.signature.api_grid, {
            page: 1,
            per_page: -1,
            filters: {search: 'all', keyword: null, filters: {}, advance_filter_id: null, advance_filters: []},
            sorting: [['created_at', 'asc']],
            parent: null
          })
          .then((response) => {
            this.signature.values = response.data.data.data;
          });
      }
    },
    getSignatureResult: function (value) {
      let options = this.signature.options.result.options;

      if (this.filled(options)) {
        for (let index in options) {
          if (options[index].value === value) {
            return options[index].label;
          }
        }
      }

      return value;
    },
    doAbort: function () {
      if (this.blank(this.urls.abort)) {
        return;
      }

      this.$swal({
        title: this.array_get(this.trans, 'ui.message.abort_alert_title'),
        text: this.array_get(this.trans, 'ui.message.abort_alert_message'),
        icon: 'warning',
        customClass: {
          confirmButton: 'btn btn-danger ml-2',
          cancelButton: 'btn btn-outline-default mr-2',
        },
        showConfirmButton: true,
        confirmButtonText: this.array_get(this.trans, 'ui.button.admit'),
        showCancelButton: true,
        cancelButtonText: this.array_get(this.trans, 'ui.button.cancel'),
        buttonsStyling: false,
        reverseButtons: true,
        focusCancel: true
      }).then((result) => {
        if (!result.isConfirmed) {
          return;
        }

        this.$swal({
          title: this.array_get(this.trans, 'ui.message.aborting'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .delete(this.urls.abort)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$swal({text: response.data.message, icon: 'success', timer: 2000});
              this.getData();
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      });
    },
    doPreview: function () {
      let previewData = JSON.parse(JSON.stringify(this.liveValues.original_data));
      if (this.blank(previewData)) {
        previewData = {};
      }
      for (let column in this.liveValues.modified_data) {
        previewData[column] = JSON.parse(JSON.stringify(this.liveValues.modified_data[column]));
      }

      axios.post(this.urls.preview, {previewData: previewData})
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
    },
    submitSign: function (result) {
      if (this.filled(this.urls.signature.store)) {
        this.signature.result = result;
        this.$store.commit('setBusy');

        axios
          .post(this.urls.signature.store, {comment: this.signature.comment, result: result ? 'approved' : 'rejected'})
          .then((response) => {
            if (response.data.code === '0000') {
              this.signature.disable = true;
              this.getData();
              this.getSignatures();
              this.$swal({text: response.data.message, icon: 'success', timer: 2000})
                .then(() => {
                  if (this.filled(response.data.data.redirect_to)) {
                    location.href = response.data.data.redirect_to;
                  }
                });
            } else {
              this.signature.result = null;
            }
          })
          .catch((error) => {
            this.signature.result = null;

            for (let column in error.response.data.errors) {
              if (error.response.data.errors.hasOwnProperty(column)) {
                this.$swal({text: error.response.data.errors[column][0], icon: 'error'});
                break;
              }
            }
          })
          .finally(() => {
            this.$store.commit('clearBusy');
          });
      }
    }
  }
}
</script>
