<?php

    class MapController extends Controller
    {
        public function draw() {
            return $this->view('map/draw');
        }

        public function drawDefault() {
            return $this->view('map/default');
        }
    }