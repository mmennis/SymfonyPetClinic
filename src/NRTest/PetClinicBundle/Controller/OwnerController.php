<?php

namespace NRTest\PetClinicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NRTest\PetClinicBundle\Entity\Owner;
use NRTest\PetClinicBundle\Form\OwnerType;

use Symfony\Component\HttpFoundation\Request;

/**
 * Owner controller.
 *
 */
class OwnerController extends Controller
{
    /**
     * Lists all Owner entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('NRTestPetClinicBundle:Owner')->findAll();

        return $this->render('NRTestPetClinicBundle:Owner:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    public function filterOwnersFormAction(Request $request)
    {
    	
    	$defaultData = array('filter' => "Enter last name", 
    						'csrf_protection' => false);
    	$form = $this->createFormBuilder($defaultData)
    		->add('filter', 'text')
    		->getForm();
    	
    	
    	return $this->render('NRTestPetClinicBundle:Owner:filter_owners.html.twig', 
    			array('form' => $form->createView()));
    }
    
    /**
     * Finds all matching owners with last name like request parameter
     * @param Request $request
     */
    public function findOwnersAction(Request $request)
    {
    	// FIXME - add code to extract filter from form data.
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$entities = $em->getRepository('NRTestPetClinicBundle:Owner')->findAllByLastName('Sm');
    	
    	return $this->render('NRTestPetClinicBundle:Owner:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Owner entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Owner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Owner entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Owner:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Owner entity.
     *
     */
    public function newAction()
    {
        $entity = new Owner();
        $form   = $this->createForm(new OwnerType(), $entity);

        return $this->render('NRTestPetClinicBundle:Owner:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Owner entity.
     *
     */
    public function createAction()
    {
        $entity  = new Owner();
        $request = $this->getRequest();
        $form    = $this->createForm(new OwnerType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('owner_show', array('id' => $entity->getId())));
            
        }

        return $this->render('NRTestPetClinicBundle:Owner:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Owner entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Owner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Owner entity.');
        }

        $editForm = $this->createForm(new OwnerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Owner:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Owner entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Owner')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Owner entity.');
        }

        $editForm   = $this->createForm(new OwnerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('owner_edit', array('id' => $id)));
        }

        return $this->render('NRTestPetClinicBundle:Owner:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Owner entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('NRTestPetClinicBundle:Owner')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Owner entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('owner'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
