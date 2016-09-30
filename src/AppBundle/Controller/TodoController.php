<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
class TodoController extends Controller
{
	/**
	 * @Route("/todo", name="todo_list")
	 */
	public function listAction()
	{
		$todo = $this->getDoctrine()->getRepository('AppBundle:Todo')->findAll();
		return $this->render('todo/index.html.twig', array('todo' => $todo));
	}

	/**
	 * @Route("/todo/create", name="todo_create")
	 */
	public function createAction(Request $request)
	{
		$session = new session();
		$todo = new Todo();
		$form = $this->createFormBuilder($todo)
			->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('date', DateTimeType::class, array('attr' => array('style' => 'margin-bottom:15px')))
			->add('save', SubmitType::class, array('label'=> 'Create', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			$now = new \DateTime('now');
			$todo->setCreated($now);
			$todo->setModified($now);
			$em = $this->getDoctrine()->getManager();
			$em->persist($data);
			$em->flush();
			$session->getFlashBag()->add('success', 'Add Successfully');
			return $this->redirectToRoute('todo_list');
		}
		return $this->render('todo/create.html.twig', array('form' => $form->createView()));
	}

	/**
	 * @Route("/todo/edit/{id}", name="todo_edit")
	 */
	public function editAction($id, Request $request)
	{
		$session = new session();
		$todo = $this->getDoctrine()->getRepository('AppBundle:Todo')->find($id);
		$form = $this->createFormBuilder($todo)
			->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('category', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('description', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
			->add('date', DateTimeType::class, array('attr' => array('style' => 'margin-bottom:15px')))
			->add('save', SubmitType::class, array('label'=> 'Update', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom:15px')))
			->getForm();
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();
			$now = new \DateTime('now');
			$todo->setCreated($now);
			$todo->setModified($now);
			$em = $this->getDoctrine()->getManager();
			$em->persist($data);
			$em->flush();
			$session->getFlashBag()->add('success', 'Update Successfully');
			return $this->redirectToRoute('todo_list');
		}
		return $this->render('todo/edit.html.twig', array('form' => $form->createView()));
	}

	/**
	 * @Route("/todo/detail/{id}", name="todo_detail")
	 */
	public function detailAction($id)
	{
		$data = $this->getDoctrine()->getRepository('AppBundle:Todo')->find($id);
		return $this->render('todo/detail.html.twig', array('data' => $data));
	}

	/**
	 * @Route("/todo/delete/{id}", name="todo_delete")
	 */
	public function deleteAction($id)
	{
		$session = new session();
		$em = $this->getDoctrine()->getManager();
		$data = $em->getRepository('AppBundle:Todo')->find($id);
		$em->remove($data);
		$em->flush();
		$session->getFlashBag()->add('success', 'Delete Successfully');
		return $this->redirectToRoute('todo_list');
	}

}
