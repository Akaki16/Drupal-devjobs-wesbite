<?php

namespace Drupal\jb_module\Controller;

use \Drupal\Core\Controller\ControllerBase;
use \Drupal\node\Entity\Node;
use \Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class JobsController extends ControllerBase {

    public function content() {

        $query = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', 'job');

        if ($query) {
            $nids = $query->execute();
        }

        $jobs = [];

        foreach ($nids as $nid) {
            $node = Node::load($nid);

            $job = [];

            $img_style = ImageStyle::load('thumbnail');
            $fid = $node->field_job_image->getValue()[0]['target_id'];
            $image_file = File::load($fid);
            $image_url = $img_style->buildUrl($image_file->uri->value);

            $job['id'] = $nid;
            $job['company_logo'] = $image_url;
            $job['full_description'] = $node->body->value;
            $job['position_title'] = $node->field_po->value;
            $job['company_location'] = $node->field_company_location->value;
            $job['company_name'] = $node->field_company_name->value;
            $job['job_posted_date'] = $node->field_job_date->value;

            $job_types = $node->field_job_type->referencedEntities();

            foreach ($job_types as $job_type) {
                $job['job_type'] = $job_type->name->value;
            }
        
            array_push($jobs, $job);
        }

        $search_form = \Drupal::formBuilder()->getForm('Drupal\jb_module\Form\SearchForm');

        return [
            '#theme' => 'job_list',
            '#jobs' => $jobs,
            '#form' => $search_form
        ];
        
    }

}