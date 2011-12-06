<?php

namespace NRTest\PetClinicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NRTest\PetClinicBundle\Entity\Pet;
use NRTest\PetClinicBundle\Form\PetType;

/**
 * Pet controller.
 *
 */
class PetController extends Controller
{
    /**
     * Lists all Pet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('NRTestPetClinicBundle:Pet')->findAll();

        return $this->render('NRTestPetClinicBundle:Pet:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Pet entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Pet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pet entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Pet:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Pet entity.
     *
     */
    public function newAction()
    {
        $entity = new Pet();
        $form   = $this->createForm(new PetType(), $entity);

        return $this->render('NRTestPetClinicBundle:Pet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Pet entity.
     *
     */
    public function createAction()
    {
        $entity  = new Pet();
        $request = $this->getRequest();
        $form    = $this->createForm(new PetType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pet_show', array('id' => $entity->getId())));
            
        }

        return $this->render('NRTestPetClinicBundle:Pet:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Pet entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Pet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pet entity.');
        }

        $editForm = $this->createForm(new PetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('NRTestPetClinicBundle:Pet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Pet entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('NRTestPetClinicBundle:Pet')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pet entity.');
        }

        $editForm   = $this->createForm(new PetType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pet_edit', array('id' => $id)));
        }

        return $this->render('NRTestPetClinicBundle:Pet:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Pet entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('NRTestPetClinicBundle:Pet')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pet entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pet'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
