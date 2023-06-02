<template>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ options.label }}</label>
    <div class="col-sm-5">
      <div class="alert alert-secondary mb-0 h-100">
        <div v-if="blank(currentBefore)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <div v-else class="file-img-list file-img-list-sm">
          <div v-for="(pic, index) in currentBefore" class="card mr-2 d-inline-block ui-sortable-handle">
            <input type="text" class="form-control form-control-sm" :value="pic.path" disabled>
            <a @click="showDetail('before', index)" class="thumb">
            <span class="imgFill imgLiquid_bgSize imgLiquid_ready"
                  v-bind:style="thumbnailStyle(asset(pic.path))">
              <img :src="asset(pic.path)" style="display:none" alt="" />
            </span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-5">
      <div class="alert alert-success mb-0 h-100">
        <div v-if="blank(currentAfter)" class="form-text text-muted">
          {{ array_get(trans, 'ui.message.empty_data') }}
        </div>
        <div v-else class="file-img-list file-img-list-sm">
          <div v-for="(pic, index) in currentAfter" class="card mr-2 d-inline-block ui-sortable-handle">
            <input type="text" class="form-control form-control-sm" :value="pic.path" disabled>
            <a @click="showDetail('after', index)" class="thumb">
            <span class="imgFill imgLiquid_bgSize imgLiquid_ready"
                  v-bind:style="thumbnailStyle(asset(pic.path))">
              <img :src="asset(pic.path)" style="display:none" alt="" />
            </span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-lg show"
         style="display: block;" role="dialog" aria-modal="true"
         v-if="currentDetail !== null"
         @click="hideDetail($event)">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a data-toggle="tab" role="tab" class="nav-link active">
                  {{ array_get(trans, 'ui.topic.image_info') }}
                </a>
              </li>
            </ul>
            <div class="tab-content mt-4">
              <div role="tabpanel" class="tab-pane fade show active">
                <div class="row">
                  <div class="col-lg-6">
                    <fieldset>
                      <legend class="legend h6 mb-4">
                        <i class="icon-angle-double-down2 mr-3"></i>{{ array_get(trans, 'ui.legend.base') }}
                      </legend>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.path') }}</label>
                        <div class="col-sm-9">
                          <div class="form-text">{{ currentDetail.path }}</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.title') }}</label>
                        <div class="col-sm-9">
                          <div class="form-text">{{ currentDetail.title }}</div>
                        </div>
                      </div>
                    </fieldset>

                    <fieldset class="mt-4">
                      <legend class="legend h6 mb-4">
                        <i class="icon-angle-double-down2 mr-3"></i>{{ array_get(trans, 'ui.legend.media') }}
                      </legend>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.media') }}</label>
                        <div class="col-sm-9">
                          <div class="form-text">{{ currentDetail.media }}</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.autoplay') }}</label>
                        <div class="col-sm-9">
                          <div v-if="parseInt(currentDetail.autoplay) === 1" class="form-text">
                            {{ array_get(trans, 'ui.image_label.autoplay_on') }}</div>
                          <div v-else class="form-text">
                            {{ array_get(trans, 'ui.image_label.autoplay_off') }}</div>
                        </div>
                      </div>
                    </fieldset>

                    <fieldset class="mt-4">
                      <legend class="legend h6 mb-4">
                        <i class="icon-angle-double-down2 mr-3"></i>{{ array_get(trans, 'ui.legend.advance') }}
                      </legend>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.cover') }}</label>
                        <div class="col-sm-9">
                          <div v-if="parseInt(currentDetail.cover) === 1" class="form-text">
                            {{ array_get(trans, 'ui.image_label.cover_on') }}</div>
                          <div v-else class="form-text">
                            {{ array_get(trans, 'ui.image_label.cover_off') }}</div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">
                          {{ array_get(trans, 'ui.image_label.device') }}</label>
                        <div class="col-sm-9">
                          <div v-if="currentDetail.device === 'desktop'" class="form-text">
                            {{ array_get(trans, 'ui.image_label.device_desktop') }}</div>
                          <div v-else-if="currentDetail.device === 'mobile'" class="form-text">
                            {{ array_get(trans, 'ui.image_label.device_mobile') }}</div>
                          <div v-else class="form-text">
                            {{ array_get(trans, 'ui.image_label.device_all') }}</div>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                  <div class="col-lg-6">
                    <img :src="asset(currentDetail.path)" style="max-width: 100%" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button"
                    @click="currentDetail = null">{{ array_get(trans, 'ui.button.cancel') }}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" v-if="currentDetail !== null"></div>
  </div>
</template>

<script>
export default {
  name: "LogAlbum",
  props: ['trans', 'configs', 'value'],
  data() {
    return {
      defaultValue: {
        path: null,
        title: null,
        media: null,
        autoplay: 0,
        device: 'all',
        cover: 0,
      },
      currentDetail: null
    }
  },
  watch: {
    currentDetail: function (value) {
      if (value === null) {
        document.body.classList.remove("modal-open");
      } else {
        document.body.classList.add("modal-open");
      }
    }
  },
  computed: {
    options: function () {
      return this.configs.options;
    },
    currentBefore: function () {
      let images = this.blank(this.value) ? [] : this.array_get(this.value, 'before');

      return this.blank(images) ? [] : images.map((pic) => {
        return {...this.defaultValue, ...pic};
      });
    },
    currentAfter: function () {
      let images = this.blank(this.value) ? [] : this.array_get(this.value, 'after');

      return this.blank(images) ? [] : images.map((pic) => {
        return {...this.defaultValue, ...pic};
      });
    }
  },
  methods: {
    initValue: function (value) {
      if (typeof value === 'boolean') {
        return value ? 1 : 0;
      }
      return value;
    },
    modalHeight: function () {
      if (window) {
        return window.innerHeight * 0.80 - 60;
      }
      return 0;
    },
    hideDetail: function ($event) {
      let classes = $event.target.classList;
      if (classes.contains('modal')) {
        this.currentDetail = null;
      }
    },
    asset: function (path) {
      if (this.blank(path)) {
        return null;
      }

      if (this.blank(this.configs.root)) {
        return path;
      }

      if (/^http/.test(path)) {
        return path;
      }

      return this.configs.root.replace(/\/$/, '') + '/' + path.replace(/^\//, '');
    },
    thumbnailStyle: function (path) {
      return {
        backgroundImage: "url(" + encodeURI(path) + ")",
        backgroundSize: "cover",
        backgroundPosition: "center center",
        backgroundRepeat: "no-repeat"
      };
    },
    showDetail: function (type, index) {
      switch (type) {
        case 'before':
          this.currentDetail = this.currentBefore[index]; break;
        case 'after':
          this.currentDetail = this.currentAfter[index]; break;
        default:
          this.currentDetail = null;
      }
    }
  }
}
</script>
