<template>
  <div class="float-right">
    <a v-if="filled(urls.back)" class="btn btn-sm btn-light"
       :href="urls.back" :title="array_get(trans, 'ui.button.back_list')">
      <i class="icon-undo2"></i><!--
      --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.back_list') }}</span>
    </a>
    <a v-if="filled(urls.create)" class="btn btn-sm btn-main"
       :href="urls.create" :title="array_get(trans, 'ui.button.create')">
      <i class="icon-plus2"></i><!--
      --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.create') }}</span>
    </a>
    <button v-if="filled(urls.trash)" class="btn btn-sm btn-dark"
            :title="array_get(trans, 'ui.button.trash')"
            @click="doTrash()">
      <i class="icon-trash"></i><!--
      --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.trash') }}</span>
    </button>
    <button v-if="filled(urls.destroy)" class="btn btn-sm btn-dark"
            :title="array_get(trans, 'ui.button.destroy')"
            @click="doDestroy()">
      <i class="icon-trash"></i><!--
      --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.destroy') }}</span>
    </button>
    <slot></slot>
    <div v-if="filled(urls.draft_list)" class="btn-group btn-group-sm dropdown" role="group">
      <button type="button" class="btn dropdown-toggle btn-main"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-libreoffice"></i><!--
        --><span class="ml-1 d-none d-md-inline-block">{{ array_get(trans, 'ui.button.draft') }}</span>
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="draft-action">
        <button type="button" class="dropdown-item" style="cursor:pointer" @click="storeDraft()">
          <i class="icon-rotate mr-2 text-muted"></i>{{ array_get(trans, 'ui.button.draft_save') }}
        </button>
        <div v-if="draftList.length > 0" class="dropdown-divider"></div>
        <div v-for="draft in draftList"
             class="dropdown-item d-flex justify-content-between"
             style="cursor:default"
             :title="draft.timestamp">
          <div class="mr-3">
            <i class="icon-time mr-2 text-muted"></i><!--
            -->{{ draft.auto ? array_get(trans, 'ui.button.draft_auto') : draft.timestamp }}
          </div>
          <div>
            <button class="btn btn-outline-default btn-sm" type="button"
                    :title="array_get(trans, 'ui.button.draft_load')"
                    @click="getDraft(draft.url_load)">
              <i class="icon-pencil"></i>
            </button>
            <button v-if="filled(draft.url_destroy)"
                    class="btn btn-outline-default btn-sm" type="button"
                    :title="array_get(trans, 'ui.button.draft_remove')"
                    @click="destroyDraft(draft.url_destroy)">
              <i class="icon-bin"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="filled(urls.language_list) && languageList.length > 1" class="btn-group btn-group-sm dropdown">
      <button class="btn dropdown-toggle btn-main" type="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="formLang">
        <i class="icon-globe"></i><!--
        --><span class="ml-1 d-none d-md-inline-block">{{ currentLanguageTitle }}</span>
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="formLang">
        <ul class="list-unstyled nav-row mb-0">
          <li v-for="(language, index) in languageList" class="dropdown-item"
              :class="{'selected': language.current}">
            <div class="row no-gutters">
              <div class="col">
                <span v-if="language.current || language.action === 'build'" style="cursor: default"
                      :class="{'text-muted': language.action === 'build'}">{{ language.title }}</span>
                <a v-else class="d-block" href="#" @click="setLanguage(language.url)">{{ language.title }}</a>
              </div>
              <div v-if="filled(language.action)" class="col text-right">
                <button v-if="language.action === 'build'"
                        class="btn btn-secondary btn-sm rounded" type="button"
                        @click="buildLanguage(language.build_url)">
                  {{ array_get(trans, 'ui.button.lang_build') }}
                </button>
                <button v-else-if="language.action === 'hide'"
                        class="btn btn-dark btn-sm rounded" type="button"
                        @click="switchLanguage(index)">
                  {{ array_get(trans, 'ui.button.lang_show') }}
                </button>
                <button v-else-if="language.action === 'show'"
                        class="btn btn-secondary btn-sm rounded" type="button"
                        @click="switchLanguage(index)">
                  {{ array_get(trans, 'ui.button.lang_hide') }}
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SitePageActions",
  props: {
    urls: Object,
    trans: Object,
    liveValues: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  data() {
    return {
      year: null,
      draftOriginal: {},
      draftTimer: null,
      draftList: [],
      languageList: []
    }
  },
  mounted() {
    this.getLanguageList();
    this.getDraftList();
  },
  computed: {
    currentLanguageTitle: function () {
      for (let index in this.languageList) {
        if (this.languageList.hasOwnProperty(index) && this.languageList[index].current) {
          return this.languageList[index].title;
        }
      }
      return this.array_get(this.trans, 'ui.button.language');
    }
  },
  watch: {
    liveValues: {
      handler: function (afterVal, beforeVal) {
        if (this.filled(this.urls.draft_save) && this.filled(beforeVal) && this.filled(afterVal)) {
          if (this.filled(this.draftOriginal) && JSON.stringify(this.draftOriginal) !== JSON.stringify(afterVal)) {
            if (this.filled(this.draftTimer)) {
              clearTimeout(this.draftTimer);
              this.draftTimer = null;
            }

            this.draftTimer = setTimeout(() => {
              this.storeDraft(true);
            }, 1000);
          }

          this.draftOriginal = JSON.parse(JSON.stringify(afterVal));
        }
      },
      deep: true
    }
  },
  methods: {
    doTrash: function () {
      if (this.blank(this.urls.trash)) {
        return;
      }

      this.$swal({
        title: this.array_get(this.trans, 'ui.message.trash_alert_title'),
        text: this.array_get(this.trans, 'ui.message.trash_alert_message'),
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
          title: this.array_get(this.trans, 'ui.message.destroying'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .delete(this.urls.trash)
          .then((response) => {
            if (response.data.code === '0000') {
              location.href = this.urls.back;
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      });
    },
    doDestroy: function () {
      if (this.blank(this.urls.destroy)) {
        return;
      }

      this.$swal({
        title: this.array_get(this.trans, 'ui.message.destroy_alert_title'),
        text: this.array_get(this.trans, 'ui.message.destroy_alert_message'),
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
          title: this.array_get(this.trans, 'ui.message.destroying'),
          icon: 'info',
          showConfirmButton: false,
          allowOutsideClick: false
        });

        axios
          .delete(this.urls.destroy)
          .then((response) => {
            if (response.data.code === '0000') {
              location.href = this.urls.back;
            } else {
              this.$swal({text: response.data.message, icon: 'error'});
            }
          })
          .catch((error) => {
            this.$swal({text: error.response.data.message, icon: 'error'});
          });
      });
    },
    getDraftList: function () {
      if (this.filled(this.urls.draft_list)) {
        axios
          .get(this.urls.draft_list)
          .then((response) => {
            if (response.data.code === '0000') {
              this.draftList = response.data.data;
            }
          });
      }
    },
    storeDraft: function (auto = false) {
      if (this.filled(this.urls.draft_save) && this.filled(this.liveValues)) {
        axios
          .post(this.urls.draft_save, {draft_data: this.liveValues, auto_save: auto ? 1 : 0})
          .then((response) => {
            if (response.data.code === '0000') {
              this.getDraftList();
            }
          });
      }
    },
    getDraft: function (api) {
      if (this.filled(api)) {
        axios
          .get(api)
          .then((response) => {
            if (response.data.code === '0000') {
              this.$emit('draft-loaded', response.data.data);
            }
          });
      }
    },
    destroyDraft: function (api) {
      if (this.filled(api)) {
        axios
          .delete(api)
          .then((response) => {
            if (response.data.code === '0000') {
              this.getDraftList();
            }
          });
      }
    },
    getLanguageList: function () {
      if (this.filled(this.urls.language_list)) {
        axios
          .get(this.urls.language_list)
          .then((response) => {
            if (response.data.code === '0000') {
              this.languageList = response.data.data;
            }
          });
      }
    },
    setLanguage: function (url) {
      if (this.filled(url)) {
        axios
          .post(url)
          .then((response) => {
            if (response.data.code === '0000') {
              location.reload();
            }
          });
      }
    },
    switchLanguage: function (index) {
      let url = this.languageList[index].switch_url;
      let switchTo = this.languageList[index].action === 'show';

      if (this.filled(url)) {
        axios
          .put(url, {"switch_to": switchTo})
          .then((response) => {
            if (response.data.code === '0000') {
              this.languageList[index].action = switchTo ? 'hide' : 'show';
            }
          });
      }
    },
    buildLanguage: function (url) {
      if (this.filled(url)) {
        axios
          .post(url)
          .then((response) => {
            if (response.data.code === '0000') {
              location.reload();
            }
          });
      }
    }
  }
}
</script>
