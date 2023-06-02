<template>
  <section class="panel h-45-c">
    <header class="panel-heading text-center">
      <h2 class="h5 px-2 float-left">{{ array_get(trans, 'module.online_users') }}</h2>
    </header>
    <div class="panel-body">
      <div class="h3 text-center font-weight-bold pb-1">
        <span class="text-main">{{ currentVisitor }}</span>
      </div>
      <div class="progress" :title="percentNewSessions + array_get(trans, 'module.new_session')" style="height:5px">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-main"
             role="progressbar"
             :style="{'width': percentNewSessions}"
             :aria-valuenow="percentNewSessions.substr(-1)"
             aria-valuemin="0"
             aria-valuemax="100"></div>
      </div>
      <div class="row text-center py-3">
        <div class="col">
          <span class="d-block text-muted small">{{ array_get(trans, 'module.session_page') }}</span>
          <span class="d-block font-weight-bold mb-1">{{ pageViewsPerSession }}</span>
        </div>
        <div class="col">
          <span class="d-block text-muted small">{{ array_get(trans, 'module.stay_time') }}</span>
          <span class="d-block font-weight-bold mb-1">{{ avgTimeOnPage }}</span>
        </div>
        <div class="col">
          <span class="d-block text-muted small">{{ array_get(trans, 'module.exit_rate') }}</span>
          <span class="d-block font-weight-bold mb-1">{{ exitRate }}</span>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "CurrentVisitor",
  props: {
    'urls': Object,
    'trans': Object,
    'days': {
      type: Number,
      default: 30
    },
    'decimals': {
      type: Number,
      default: 2
    }
  },
  data() {
    return {
      currentVisitor: '-',
      percentNewSessions: '0.00%',
      pageViewsPerSession: '-',
      avgTimeOnPage: '-',
      exitRate: '-'
    }
  },
  mounted: function () {
    this.updateData();
  },
  methods: {
    updateData: function () {
      if (this.filled(this.urls.current_visitor)) {
        axios.get(this.urls.current_visitor + '?days=' + this.days + '&decimals=' + this.decimals)
          .then((response) => {
            this.currentVisitor = response.data.currentVisitor;
            this.percentNewSessions = response.data.percentNewSessions;
            this.pageViewsPerSession = response.data.pageViewsPerSession;
            this.avgTimeOnPage = response.data.avgTimeOnPage;
            this.exitRate = response.data.exitRate;
          });
      }
    }
  }
}
</script>
