<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Category;
use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
class CategoryController extends Controller
{
	/**
	 * @Route("/category", name="category_list")
	 */
	public function listAction()
	{
		$todo = $this->getDoctrine()->getRepository('AppBundle:Category')->findAll();
		return $this->render('category/index.html.twig', array('todo' => $todo));
	}

	/**
	 * @Route("/category/create", name="category_create")
	 */
	public function createAction(Request $request)
	{
		$session = new session();
		$Category = new Category();
		$form = $this->createFormBuilder($Category)
			->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('parent_id', EntityType::class, array('placeholder' => 'Choose an option', 'choice_value' => 'id', 'choice_label' => 'name', 'required' => false, 'class' => 'AppBundle:Category', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('save', SubmitType::class, array('label'=> 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			if ($form['parent_id']->getData() == '') {
				$Category->setParentId(0);
			} else {
				$parentId = $form['parent_id']->getData();
				var_dump($parentId);die;
				$Category->setParentId($parentId->id);
			}
			$now = new \DateTime('now');
			$Category->setCreated($now);
			$Category->setModified($now);
			$em = $this->getDoctrine()->getManager();
			$em->persist($data);
			$em->flush();
			$session->getFlashBag()->add('success', 'Add Successfully');
			return $this->redirectToRoute('category_list');
		}
		return $this->render('category/create.html.twig', array('form' => $form->createView()));
	}

	/**
	 * @Route("/category/edit/{id}", name="category_edit")
	 */
	public function editAction($id, Request $request)
	{
		$session = new session();
		$Category = $this->getDoctrine()->getRepository('AppBundle:Category')->find($id);
		$form = $this->createFormBuilder($Category)
			->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('parent_id', EntityType::class, array('choice_value' => 'id', 'choice_label' => 'name', 'class' => 'AppBundle:Category', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('save', SubmitType::class, array('label'=> 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			$now = new \DateTime('now');
			$Category->setCreated($now);
			$Category->setModified($now);
			$em = $this->getDoctrine()->getManager();
			$em->persist($data);
			$em->flush();
			$session->getFlashBag()->add('success', 'Update Successfully');
			return $this->redirectToRoute('category_list');
		}
		return $this->render('category/edit.html.twig', array('form' => $form->createView()));
	}

	/**
	 * @Route("/category/detail/{id}", name="category_detail")
	 */
	public function detailAction($id)
	{
		$data = $this->getDoctrine()->getRepository('AppBundle:Category')->find($id);
		return $this->render('category/detail.html.twig', array('data' => $data));
	}

	/**
	 * @Route("/category/delete/{id}", name="category_delete")
	 */
	public function deleteAction($id)
	{
		$session = new session();
		$em = $this->getDoctrine()->getManager();
		$data = $em->getRepository('AppBundle:Category')->find($id);
		$em->remove($data);
		$em->flush();
		$session->getFlashBag()->add('success', 'Delete Successfully');
		return $this->redirectToRoute('category_list');
	}

}
