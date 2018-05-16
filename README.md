Annotation Processor — utility for parsing constants from the description of the test methods
========================================================

##  Install

### 1. Download project from the repository

Navigate to the directory where you want to store the directory with project. For instance, your home directory `cd ~`.

`git clone git@github.com:sakharovmaksim/annotation-processor.git`

And when downloading is done, navigate to the project directory `cd annotation-processor`.

### 2. Install dependencies

`composer install`

##  Usage
In your TestCase-class in setUp()-method, which extends from \PHPUnit\Framework\TestCase use function like:
```
private function _processAnnotations()
	{
		$class = get_class($this);
		$methodName = $this->getName(false);
		$annotationProcessor = new AnnotationProcessor($class, $methodName);

		// @domains
		if ($domainsExcept = $annotationProcessor->process(new Annotation\ArrayAnnotation(AnnotationsNames::DOMAINS_EXCEPT)))
		{
			if (Env::isRC() && in_array(Env::RC, $domainsExcept))
			{
				$this->markTestSkipped("Skip the test that is not for RC: {$class}::{$methodName}");
			}
			elseif (Env::isProduction() && in_array(Env::PROD, $domainsExcept))
			{
				$this->markTestSkipped("Skip the test that is not for Production: {$class}::{$methodName}");
			}
			elseif (Env::isStand() && in_array(Env::STAND, $domainsExcept))
			{
				$this->markTestSkipped("Skip the test that is not for stands: {$class}::{$methodName}");
			}
		}

		// @bug
		if ($annotationProcessor->process(new Annotation\BoolAnnotation(AnnotationsNames::BUG)))
		{
			$this->markTestSkipped("Skip the test {$class}::{$methodName}, because it has deactivated due to a @bug!");
		}
		// @todocase
		if ($annotationProcessor->process(new Annotation\BoolAnnotation(AnnotationsNames::TODOCASE)))
		{
			$this->markTestSkipped("Skip the test {$class}::{$methodName}, because it has @todocase, write it!");
		}
	}
}
```
This function, when starting each test, will analyze the constants from the description and apply the actions described in the function above.
