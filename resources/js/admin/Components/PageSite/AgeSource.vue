<template>
  <section class="panel h-100-c">
    <header class="panel-heading">
      <h2 class="h5 float-left">{{ array_get(trans, 'module.age_source') }}</h2>
    </header>
    <div class="panel-wrapper"></div>
    <div class="panel-body pb-3">
      <div id="age-source-serial"></div>
    </div>
  </section>
</template>

<script>
import 'amcharts3';
import 'amcharts3/amcharts/serial';
import 'amcharts3/amcharts/themes/light';

export default {
  name: "AgeSource",
  props: {
    'urls': Object,
    'trans': Object,
    'days': {
      type: Number,
      default: 30
    }
  },
  data() {
    return {
      serialChart: null,
      ageSource: []
    }
  },
  mounted: function () {
    this.createAmSerial();
  },
  watch: {
    ageSource: function (afterVal, beforeVal) {
      if (JSON.stringify(afterVal) !== JSON.stringify(beforeVal)) {
        this.serialChart.dataProvider = afterVal;
        this.$nextTick(() => {
          this.serialChart.validateData();
          this.serialChart.animateAgain();
        });
      }
    }
  },
  methods: {
    createAmSerial: function () {
      this.serialChart = AmCharts.makeChart("age-source-serial", {
        "hideCredits":true,
        "type": "serial",
        "theme": "light",
        "dataProvider": this.ageSource,
        "valueAxes": [{"gridColor": "#878787", "gridAlpha": 0.2, "dashLength": 0, "color": "#878787"}],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [{
          "balloonText": "[[category]]: <b>[[value]]</b>",
          "fillAlphas": 0.8,
          "lineAlpha": 0.2,
          "type": "column",
          "valueField": "visits",
          "color": "#878787"
        }],
        "chartCursor": {"categoryBalloonEnabled": false, "cursorAlpha": 0, "zoomable": false},
        "categoryField": "age",
        "categoryAxis": {
          "gridPosition": "start",
          "gridAlpha": 0,
          "tickPosition": "start",
          "tickLength": 20,
          "color": "#878787"
        },
        "export": {"enabled": false}
      });
      this.updateAgeSource();
    },
    updateAgeSource: function () {
      if (this.filled(this.urls.age_source)) {
        axios.get(this.urls.age_source + '?days=' + this.days)
          .then((response) => {
            this.ageSource = response.data;
          });
      }
    }
  }
}
</script>

<style scoped>
#age-source-serial {
  height: 265px;
}
</style>
