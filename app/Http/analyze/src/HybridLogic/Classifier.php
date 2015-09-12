<?php namespace App\Http\analyze\src\HybridLogic;


class Classifier extends Model {

	protected $subjects = array();

	protected $tokens = array();

	protected $total_samples = 0;

	protected $total_tokens = 0;

	protected $tokenizer;

	public function __construct($tokenizer) {

		$this->tokenizer = $tokenizer;

	} // end func: __construct

	public function train($subject, $rows) {

		if(!isset($this->subjects[$subject])) {
			$this->subjects[$subject] = array(
				'count_samples' => 0,
				'count_tokens'  => 0,
				'prior_value'   => null,
			);
		}

		if(empty($rows)) return $this;
		if(!is_array($rows)) $rows = array($rows);

		foreach($rows as $row) {

			$this->total_samples++;
			$this->subjects[$subject]['count_samples']++;

			$tokens = $this->tokenizer->tokenize($row);

			foreach($tokens as $token) {

				if(!isset($this->tokens[$token][$subject])) $this->tokens[$token][$subject] = 0;

				$this->tokens[$token][$subject]++;
				$this->subjects[$subject]['count_tokens']++;
				$this->total_tokens++;

			}

		}

	} // end func: train

	public function classify($string) {

		if($this->total_samples === 0) return array();

		$tokens      = $this->tokenizer->tokenize($string);
		$total_score = 0;
		$scores      = array();

		foreach($this->subjects as $subject => $subject_data) {

			$subject_data['prior_value'] = log($subject_data['count_samples'] / $this->total_samples);
			$this->subjects[$subject] = $subject_data;
			$scores[$subject] = 0;

			foreach($tokens as $token) {
				$count = isset($this->tokens[$token][$subject]) ? $this->tokens[$token][$subject] : 0;
				$scores[$subject] += log( ($count + 1) / ($subject_data['count_tokens'] + $this->total_tokens) );
			}

			$scores[$subject] = $subject_data['prior_value'] + $scores[$subject];
			$total_score += $scores[$subject];

		}

		$min = min($scores);
		$sum = 0;
		foreach($scores as $subject => $score) {
			$scores[$subject] = exp($score - $min);
			$sum += $scores[$subject];
		}

		$total = 1 / $sum;
		foreach($scores as $subject => $score) {
			$scores[$subject] = $score * $total;
		}
        arsort($scores);
		
        $max = max($scores);

        $maxs = array_search(max($scores),$scores);
        return $maxs;


        

		

	} // end func: classify



} // end class: Classifier